<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\DetailAgenda;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'agendas' => Agenda::query()->with('persons.teacher')->get()
        ];

        return view('dashboard.agenda.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'teachers' => Teacher::query()->with('agendas.agenda')->get()
        ];
        return view('dashboard.agenda.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $agenda = Agenda::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        foreach ($request->peserta as $peserta) {
            DetailAgenda::create([
                'agenda_id' => $agenda->id,
                'teacher_id' => $peserta,
            ]);
        }

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
