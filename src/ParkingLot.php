<?php
/**
 * Initial Version of ParkingLot.php Created By:
 *
 * User: nitishkumar | <nitish.kumar@sugaldamani.com>
 * Date: 11/09/19
 * Time: 3:33 PM
 */

class ParkingLot
{
    const SLOT_FILLED = 1;
    const SLOT_FREE = 0;

    private $capacity;
    private $slots = [];
    private $vehicle = [];

    public static function instance($capacity)
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new static($capacity);
        }

        return $instance;
    }

    private function __construct($capacity) {
        $this->capacity = $capacity;

        for ($i = 0; $i < $this->capacity; $i++) {
            $this->slots[$i] = self::SLOT_FREE;
        }
    }

    private function __clone() {}

    private function verifySlotNumber($slot) {
        return $slot < $this->capacity;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function getSlots() {
        return $this->slots;
    }

    public function getFreeSlot() {
        return array_search(self::SLOT_FREE, $this->slots, true);
    }

    public function setSlotFilled(int $slot, string $registrationNo, string $color) {
        if (!$this->verifySlotNumber($slot)) {
            throw new ErrorException("Invalid Slot Number!", 422);
        }

        $recorded = $this->recordVehicleDetails($slot, $registrationNo, $color);

        if (!$recorded) {
            return false;
        }

        $this->slots[$slot] = self::SLOT_FILLED;

        return true;
    }

    public function setSlotFree(int $slot) {
        if (!$this->verifySlotNumber($slot)) {
            throw new ErrorException("Invalid Slot Number!", 422);
        }

        $this->slots[$slot] = self::SLOT_FREE;
    }

    public function isParkingLotCreated() {
        return ($this->capacity > 0);
    }

    private function recordVehicleDetails(int $slot, string $registrationNo, string $color) {
        if (array_key_exists($registrationNo, $this->vehicle)) {
            return false;
        }

        $this->vehicle[$registrationNo] = $color.'-'.$slot;

        return true;
    }

    private function removeVehicleDetails($slot) {
        $filteredArr = array_filter($this->vehicle, function ($value) use ($slot) {
            return (explode('-', $value)[1] == $slot);
        });

        $key = array_keys($filteredArr);

        unset($this->vehicle[$key[0]]);
    }
}
