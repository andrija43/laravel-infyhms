<?php

namespace App\Queries;

use App\Models\LiveMeeting;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LiveMeetingDataTable
 */
class LiveMeetingDataTable
{
    public function get(array $input = []): LiveMeeting
    {
        /** @var LiveMeeting $query */
        $query = LiveMeeting::whereHas('user')->with(['user', 'members'])->select('live_meetings.*');

        $query->when(isset($input['status']) && $input['status'] != LiveMeeting::status,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        if (getLoggedInUser()->hasRole('Receptionist')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Doctor')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Nurse')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Accountant')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Lab Technician')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Pharmacist')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Case Manager')) {
            $this->query($query);
        }

        return $query;
    }

    public function query(array $query)
    {
        $query->whereHas('members', function (Builder $query) {
            $query->where('user_id', '=', getLoggedInUserId());
        });
    }
}
