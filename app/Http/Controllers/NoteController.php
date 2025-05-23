<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
   public function index() {
        $notes = Note::all();
        return view('notes.index', compact('notes')); 
   }

   public function create() {
      return view('notes.create');
   }

   public function store(Request $request)
   {
      // dd($request->all());
      $request->validate([
         'judul' => 'required|max:255',
         'konten' => 'required',
         'tanggal_dibuat' => 'required|date',
      ], [
         'judul.required' => 'Judul wajib diisi.',
         'konten.required' => 'Konten wajib diisi.',
         'tanggal_dibuat.required' => 'Tanggal dibuat wajib diisi.',
      ]);
      Note::create($request->all());
      return redirect()->route('notes.index')->with('success', 'Catatan berhasil ditambahkan.');
   }
   public function show($id)
   {
      $note = Note::findOrFail($id);
      return view('notes.show', compact('note'));
   }

   public function edit($id)
   {
      $note = Note::findOrFail($id);
      return view('notes.edit', compact('note'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'judul' => 'required|max:255',
         'konten' => 'required',
         'tanggal_dibuat' => 'required|date',
      ], [
         'judul.required' => 'Judul wajib diisi.',
         'konten.required' => 'Konten wajib diisi.',
         'tanggal_dibuat.required' => 'Tanggal wajib diisi.',
      ]);

      $note = Note::findOrFail($id);
      $note->update($request->all());

      return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui.');
   }

   public function destroy($id)
   {
      $note = Note::findOrFail($id);
      $note->delete();

      return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus.');
   }
}
