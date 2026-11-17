<?php

use App\DAO\NoteDAO;
use Core\App;

$dao = App::resolve(NoteDAO::class);

$note = $dao->findById((int) $_POST['id']) ?? abort();

authorize($note->userId === $_SESSION['user']['id']);

$dao->delete($note->id);

redirect('/notes');