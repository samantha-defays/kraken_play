<?php

class AdminEventEditor
{
    public static function CreateView()
    {
        $model = new EventModel;
        $event = $model->getEventInfoById($_GET['id']);

        if (!empty($_POST)) {

            $title = $_POST['titleEvent'];
            $difficulty = $_POST['eventDifficulty'];
            $level = $_POST['eventLevel'];

            // exploding date and time to prevent non well formed numeric errors
            $date = explode('-', $_POST['eventDate']);
            $year = $date[0];
            $month = $date[1];
            $day = $date[2];

            $startTime = explode(':', $_POST['eventStart']);
            $endTime = explode(':', $_POST['eventEnd']);
            $startHour = $startTime[0];
            $startMinutes = $startTime[1];
            $endHour = $endTime[0];
            $endMinutes = $endTime[1];

            // forming the new date 

            $dateStart = "$year-$month-$day $startHour:$startMinutes";
            $dateEnd = "$year-$month-$day $endHour:$endMinutes";

            $startAt = date('Y-m-d H:i:s', strtotime($dateStart));
            $endAt = date('Y-m-d H:i:s', strtotime($dateEnd));

            $model->updateEvent($title, $difficulty, $level, $startAt, $endAt, $event['id']);
            header('Location: ./admin-events');
            exit();
        }

        $variables = compact('event');

        Utils::render('AdminEventEditor', $variables);
    }
}
