<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Models\Properties\ContactProperty;
use Symfony\Component\HttpFoundation\Response;

class ContactController
{
    public function index()
    {
        $contact = new Contact;
        $contacts = $contact->all();

        return json_encode([
            'success' => is_array($contacts),
            'data' => $contact->all()
        ]);
    }

    public function show($request, $id)
    {
        $contact = new Contact;
        $data = $contact->find($id);

        return json_encode([
            'success' => !empty($data['id']),
            'data' => $data,
        ]);
    }

    public function store($request)
    {
        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'gender' => (int) $request->get('gender'),
        ];

        $contact = new Contact;
        $data['id'] = $contact->create($data);

        return json_encode([
            'success' => !empty($data['id']),
            'data' => $data,
        ]);
    }

    public function update($request, $id)
    {
        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'gender' => (int) $request->get('gender'),
        ];

        $contact = new Contact;
        $result = $contact->update($id, $data);

        return json_encode([
            'success' => $result,
            'data' => $data + ['id' => $id],
        ]);
    }
    
    public function destroy($request, $id)
    {
        $contact = new Contact;
        return json_encode([
            'success' => $contact->delete($id),
            'data' => compact('id'),
        ]);
    }
}