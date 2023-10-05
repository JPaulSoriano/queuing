<?php

namespace App\Http\Controllers;
use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return view('queue.index');
    }

    public function reg(Request $request)
    {
        // Get the number of queues for each registrar
        $registrarQueues = [];
        for ($i = 1; $i <= 4; $i++) { // Assuming you have 4 registrars
            $registrarQueues[$i] = Queue::where('registrar_number', $i)->count();
        }

        // Check if there are any queues in any registrar
        $totalQueues = array_sum($registrarQueues);

        if ($totalQueues > 0) {
            // Find the registrar with the least queues
            $minQueueRegistrar = array_search(min($registrarQueues), $registrarQueues);
        } else {
            // If there are no queues, assign a random registrar
            $minQueueRegistrar = rand(1, 4); // Assuming 4 registrars
        }

        // Calculate the next unique queue number
        $lastQueue = Queue::orderBy('queue_number', 'desc')->first();
        $queueNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1;

        $customerName = $request->input('customer_name');
        
        Queue::create([
            'customer_name' => $customerName,
            'queue_number' => $queueNumber,
            'registrar_number' => $minQueueRegistrar,
        ]);
        return redirect()->route('queue.index')->with('success', 'Queue #' . $queueNumber . 'Registrar' . $minQueueRegistrar);
    }

    public function callQueue($registrarNumber)
    {
        $currentQueue = Queue::where('registrar_number', $registrarNumber)->orderBy('created_at', 'asc')->first();
        
        $queues = Queue::where('registrar_number', $registrarNumber)->orderBy('created_at', 'asc')->get();
    
        return view('queue.call', [
            'currentQueue' => $currentQueue,
            'queues' => $queues,
            'currentRegistrarNumber' => $registrarNumber,
        ]);
    }
    public function callNextQueue($registrarNumber)
    {
        $nextQueue = Queue::where('registrar_number', $registrarNumber)->orderBy('created_at', 'asc')->first();

        if ($nextQueue) {
            $nextQueue->delete();
        }

        return redirect()->route('queue.call', $registrarNumber);
    }
    public function refreshQueue($registrarNumber)
    {
        return redirect()->route('queue.call', $registrarNumber);
    }
}
