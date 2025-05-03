<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Получение всех клиентов
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    // Создание нового клиента
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
        ]);

        // Создание клиента
        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    // Обновление клиента
    public function update(Request $request, $id)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        // Обновление данных клиента
        $client->update($request->all());

        return response()->json($client);
    }

    // Удаление клиента
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        // Удаление клиента
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully']);
    }
}
