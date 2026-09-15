<?php

namespace App\Http\Controllers {

    use Illuminate\Support\Facades\Gate;
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades;
    use Illuminate\Support;
    use App\Http\Requests;
    use Inertia\Response;
    use App\Models\User;
    use Illuminate\Http;
    use App\Models;

    class UserController extends Controller
    {
        /**
         * Display a list of resources
         *
         * @return Response
         */
        public function index(): Response
        {
            Gate::authorize('view_users');

            $users = Models\User::withoutRole('admin')->withoutTrashed()->with('roles')->paginate(10);
            $roles = Role::all();

            return inertia('users/index', compact('users', 'roles'));
        }

        /**
         * Display the specified resource.
         *
         * @param Models\User|null $user
         *
         * @return Response
         */
        public function show(Models\User|null $user = null): Response
        {
            $user ??= auth()->user();

            Gate::authorize('view', $user);

            $properties = Models\Property::withoutTrashed()->with('users')->get()
                ->each(function (Models\Property $property) use ($user) {
                    $property['hasAccess'] = $property->users->contains('id', $user['id']);
                });

            return inertia('users/show', [
                'properties' => $properties,
                'user'       => $user->load('properties'),
            ]);
        }

        public function store(Requests\Users\StoreUser $request): Http\RedirectResponse
        {
            Gate::authorize('create_users');

            $user = User::create([
                'username' => str($request->username)->slug(),
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Facades\Hash::make($request->password),
            ]);

            // assign role
            $user->assignRole($request['role']);
            return back();
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Requests\Users\UpdateUser $request
         * @param Models\User               $user
         *
         * @return Http\RedirectResponse
         */
        public function update(Requests\Users\UpdateUser $request, Models\User $user): Http\RedirectResponse
        {
            Gate::authorize('update_user');

            $request->validated();

            $user->update([
                'name'     => $request->name ?: $user['name'],
                'username' => $request->username ? str($request->username)->slug(separator: '_') : $user['username'],
                'email'    => $request->email ?: $user['email'],
                'password' => $request->password ? Support\Facades\Hash::make($request->password) : $user['password'],
            ]);

            return to_route('users.show', $user);
        }


        /**
         * @param Http\Request         $request
         * @param Models\Property $property
         *
         * @return Http\RedirectResponse
         */
        public function assignProperty(Models\User $user, Models\Property $property): Http\RedirectResponse
        {
            $user->properties()->toggle($property);

            return back();
        }

        /**
         * Update a users' image
         *
         * @param Http\Request $request
         *
         * @return Http\RedirectResponse
         */
        public function updateImage(Http\Request $request): Http\RedirectResponse
        {
            try {
                $file = $request->file('image');
                $user = Models\User::find(auth()->id());

                $path = '/storage/avatars/' . auth()->id();

                $user->update([
                    'avatar' => $path . '.' . $file->getClientOriginalExtension()
                ]);

                Support\Facades\Storage::disk('public')->putFileAs('avatars', $file, auth()->id() . '.' . $file->getClientOriginalExtension());
            } catch (\Throwable $e) {
                throw new \RuntimeException($e->getMessage());
            }

            return back();
        }

        /**
         * Delete a record from storage
         *
         * @param Models\User $user
         *
         * @return Http\RedirectResponse
         */
        public function destroy(Models\User $user): Http\RedirectResponse
        {
            Gate::authorize('delete_user');

            $user->delete();

            return back();
        }
    }
}
