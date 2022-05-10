<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OvertimePay extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->employee->id,
            'name' => $this->employee->name,
            'status' => $this->employee->reference->name,
            'salary' => $this->employee->salary,
            'overtimes' => [
                'date' => $this->date,
                'time_started' => date('H:i', strtotime($this->time_started)),
                'time_ended' => date('H:i', strtotime($this->time_ended)),
                'overtime_duration' => $this->calculation($this->time_ended, $this->time_started),
            ],
            'overtime_duration_total' => $this->overtimeTotal($this->employee->id, $request->month),
            'amount' => $this->amount($this->employee->id, $request->month)
        ];
    }
}
