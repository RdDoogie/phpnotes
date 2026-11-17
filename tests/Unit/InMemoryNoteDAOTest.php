<?php

use App\DAO\InMemoryNoteDAO;
use App\DTO\NoteDTO;

test('it creates and finds notes by user', function () {
    $dao = new InMemoryNoteDAO();

    $id = $dao->create(new NoteDTO(null, 'Hola', 1));
    $dao->create(new NoteDTO(null, 'De otro', 2));

    expect($dao->findById($id)->body)->toBe('Hola')
        ->and($dao->findByUser(1))->toHaveCount(1);
});

test('it deletes a note', function () {
    $dao = new InMemoryNoteDAO();
    $id = $dao->create(new NoteDTO(null, 'Borrar', 1));

    $dao->delete($id);

    expect($dao->findById($id))->toBeNull();
});