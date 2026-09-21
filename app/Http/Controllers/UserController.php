<?php

namespace App\Http\Controllers {

    use Illuminate\Support\Facades\Gate;
    use Spatie\Permission\Models\Role;
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
            // user data
            $user ??= auth()->user();

            // authorization
            Gate::authorize('view', $user);

            // users' properties
            $properties = Models\Property::withoutTrashed()->with('users')->get()
                ->each(function (Models\Property $property) use ($user) {
                    $property['hasAccess'] = $property->users->contains('id', $user['id']);
                });

            // inertia response
            return inertia('users/show', [
                'properties' => $properties,
                'user'       => $user->load('properties'),
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Requests\Users\StoreUser $request
         *
         * @return Http\RedirectResponse
         */
        public function store(Requests\Users\StoreUser $request): Http\RedirectResponse
        {
            // authorization
            Gate::authorize('create_users');

            // create the record
            $user = User::create($request->validated());

            // assign role
            $user->assignRole($request['role']);

            // redirect
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
            // authorization
            Gate::authorize('update_profile');

            // update the record
            $user->update($request->validated());

            // redirect
            return to_route('users.show', $user);
        }

        /**
         * Assign a property to a user record
         *
         * @param User            $user
         * @param Models\Property $property
         *
         * @return Http\RedirectResponse
         */
        public function assignProperty(Models\User $user, Models\Property $property): Http\RedirectResponse
        {
            // toggle the record
            $user->properties()->toggle($property);

            // redirect
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
            // authorization
            Gate::authorize('update_profile_image');

            // file uploading
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

            // redirect
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
            // authorization
            Gate::authorize('delete_user');

            // delete the record
            $user->delete();

            // redirect
            return back();
        }
    }
}
