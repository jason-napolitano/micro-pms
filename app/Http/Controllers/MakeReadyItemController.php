<?php

namespace App\Http\Controllers {

    use App\Http\Requests\MakeReady;
    use App\Models;
    use Illuminate\Http;

    class MakeReadyItemController extends Controller
    {
        /**
         * Update the specified resource in storage.
         *
         * @param MakeReady\UpdateSchedule $request
         * @param Models\MakeReadyItem     $item
         *
         * @return Http\RedirectResponse
         */
        public function updateScheduling(MakeReady\UpdateSchedule $request, Models\MakeReadyItem $item): Http\RedirectResponse
        {
            // update the model
            if ($request['scheduled_start_at'] || $request['scheduled_end_at']) {
                // input validation
                $request->validated();

                $item['scheduled_start_at'] = $request['scheduled_start_at'];
                $item['scheduled_end_at'] = $request['scheduled_end_at'];
                $item['status'] = Models\Enums\MakeReadyStatus::SCHEDULED;
                $item->save();

            } else {
                $item->update($request->validated());
            }

            // redirect
            return back();
        }

        /**
         * Update the status of a record
         *
         * @param MakeReady\UpdateStatus $request
         * @param Models\MakeReadyItem   $item
         *
         * @return Http\RedirectResponse
         */
        public function updateStatus(MakeReady\UpdateStatus $request, Models\MakeReadyItem $item): Http\RedirectResponse
        {
            // input validation
            $request->validated();

            // update the model
            if ($request['status'] === 'completed') {
                $item['completed_at'] = now();
                $item['status'] = Models\Enums\MakeReadyStatus::COMPLETED;
            }
            if ($request['status'] === 'cancelled') {
                $item['cancelled_at'] = now();
                $item['status'] = Models\Enums\MakeReadyStatus::CANCELLED;
            }
            if ($request['status'] === 'on_hold') {
                $item['on_hold_at'] = now();
                $item['status'] = Models\Enums\MakeReadyStatus::ON_HOLD;
            }

            // save the data
            $item->save();

            // redirect
            return back();
        }

        /**
         * Update the assignee of a record
         *
         * @param MakeReady\UpdateAssignee $request
         * @param Models\MakeReadyItem     $item
         *
         * @return Http\RedirectResponse
         */
        public function updateAssignee(MakeReady\UpdateAssignee $request, Models\MakeReadyItem $item): Http\RedirectResponse
        {
            // input validation
            $request->validated();

            // update the model
            if ($request['assigned_to']) {
                $item->update([
                    'assigned_to' => $request['assigned_to'],
                    'vendor_id'   => null
                ]);
            }

            if ($request['vendor_id']) {
                $item->update([
                    'assigned_to' => null,
                    'vendor_id'   => $request['vendor_id'],
                ]);
            }

            // redirect
            return back();
        }

        /**
         * Update the notes of a record
         *
         * @param MakeReady\UpdateNotes $request
         * @param Models\MakeReadyItem  $item
         *
         * @return Http\RedirectResponse
         */
        public function updateNotes(MakeReady\UpdateNotes $request, Models\MakeReadyItem $item): Http\RedirectResponse
        {
            // update the model
            $item->update($request->validated());

            // redirect
            return back();
        }
    }
}
