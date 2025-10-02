<?php

namespace App\Filament\Resources\Classrooms\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Resources\Clasrooms\ClassroomResource;
use App\Models\TeachingSchedule;
use Saade\FilamentFullCalendar\Data\EventData;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions;
use Filament\Actions\Action;
use Filament\Forms;

class ScheduleCalendarWidget extends FullCalendarWidget
{
    public Model | string | int | null $record = null;

    public Model | string | null $model = TeachingSchedule::class;
    
    protected function getOptions(): array
    {
        return [
            'initialView' => 'timeGridWeek',
            'headerToolbar' => [
                'left' => 'prev,next', 'center' => 'title', 'right' => 'timeGridWeek,timeGridDay',
            ],
            'allDaySlot' => false, 'locale' => 'id', 'slotMinTime' => '07:00:00', 'slotMaxTime' => '16:00:00',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function viewAction(): Action
    {
        return Actions\ViewAction::make();
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name'),

            Forms\Components\Grid::make([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 3,
                    'lg' => 4,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    Forms\Components\DateTimePicker::make('starts'),
                    Forms\Components\DateTimePicker::make('ends'),
                ]),
                
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        if (! $this->record) {
            return [];
        }

        $today = date('Y-m-d');

        return TeachingSchedule::with(['subject', 'teacher.user'])
            ->where('classroom_id', $this->record->id)
            ->get()
            ->map(
                function (TeachingSchedule $schedule) use ($today) {
                    return [
                        'id' => $schedule->id,
                        'title' => $schedule->subject->name . ' - ' . $schedule->teacher->user->name,
                        'start' => $today . ' ' . $schedule->start_time,
                        'end' => $today . ' ' . $schedule->end_time,
                        'daysOfWeek' => [$this->dayToNumber($schedule->day_of_week)],
                    ];
                }
            )
            ->all();
    }

    protected function dayToNumber(string $day): int
    {
        return match (strtolower($day)) {
            'minggu' => 0, 'senin' => 1, 'selasa' => 2, 'rabu' => 3,
            'kamis' => 4, 'jumat' => 5, 'sabtu' => 6, default => 1,
        };
    }
}
