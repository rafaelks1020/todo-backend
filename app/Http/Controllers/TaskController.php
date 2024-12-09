<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Lista todas as tarefas do usuário autenticado
    public function index()
    {
        // Retorna as tarefas paginadas, com 10 por página
        $tasks = Auth::user()->tasks()->paginate(10);
    
        return response()->json($tasks);
    }
    

    // Cria uma nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false, // Inicializa como não concluída
        ]);

        return response()->json($task, 201);
    }

    // Atualiza uma tarefa existente
    public function update(Request $request, $id)
    {
        // Valida os dados recebidos
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);
    
        // Busca a tarefa pelo ID
        $task = Task::findOrFail($id);
    
        // Verifica se a tarefa pertence ao usuário autenticado
        if ($task->user_id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Atualiza os dados da tarefa
        $task->update($request->only(['title', 'description', 'completed']));
    
        // Retorna a tarefa atualizada
        return response()->json($task);
    }
    

    // Deleta uma tarefa
    public function destroy(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted'], 200);
    }
}
