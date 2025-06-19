<?php

namespace App\Observers;

use App\Actions\Traits\ClearCache;

class BookingObserver
{
    use ClearCache;

    /**
     * Summary of created
     * @return void
     */
    public function created(): void
    {
        $this->clear([
            'bookings',
            'bookings:show',
        ]);
    }

    /**
     * Summary of updated
     * @return void
     */
    public function updated(): void
    {
        $this->clear([
            'bookings',
            'bookings:show',
        ]);
    }

    /**
     * Summary of deleted
     * @return void
     */
    public function deleted(): void
    {
        $this->clear([
            'bookings',
            'bookings:show',
        ]);
    }

    /**
     * Summary of restored
     * @return void
     */
    public function restored(): void
    {
        $this->clear([
            'bookings',
            'bookings:show',
        ]);
    }

    /**
     * Summary of forceDeleted
     * @return void
     */
    public function forceDeleted(): void
    {
        $this->clear([
            'bookings',
            'bookings:show',
        ]);
    }
}
