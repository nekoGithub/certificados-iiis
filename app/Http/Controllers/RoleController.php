<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        $roles = Role::all();
        return view('sistema.adminUser.roles', [
            'permisos' => $permisos,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            $role = Role::create([
                'name' => $request->input('nombre')
            ]);
            return back()->with('success', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un problema al crear el rol: ' . $e->getMessage());
        }
    }


    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');

        $role->syncPermissions($request->input('permissions', []));

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol Actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->back()->with('success', 'Rol Eliminado con exito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error'. $e->getMessage());
        }
    }
}
