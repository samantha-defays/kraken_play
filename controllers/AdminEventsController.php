<?php

class AdminEvents
{
    // deleting an event
    public function deleteEvent($id)
    {
        $model = new EventModel();
        $model->deleteEvent($id);

        header('Location: ./admin-events');
        exit();
    }

    public static function CreateView()
    {
        $model = new EventModel;
        $events = $model->getEventList();

        $variables = compact('events');

        Utils::render('AdminEvents', $variables);
    }
}
