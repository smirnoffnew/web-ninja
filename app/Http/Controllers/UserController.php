<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        return response()->json(User::all());
    }

    public function getUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(
                [
                    'message' => 'User not found!',
                ], 404);
        }
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'isAdmin' => 0
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Successfully created user!',
                'user' => $user
            ], 201);
        } else {
            return response()->json(
                [
                    'message' => 'Something went wrong on create user',
                    'user' => $user
                ], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'string|email|unique:users',
            'password' => 'string',
            'isAdmin' => 'boolean'
        ]);

        $user = User::find($id);

        if ($user) {
            if ($user->update($request->all())) {
                return response()->json([
                    'message' => 'Successfully updated user!',
                    'user' => $user
                ], 200);
            } else {
                return response()->json(
                    [
                        'message' => 'Something went wrong on update user',
                        'user' => $user
                    ], 500);
            }
        } else {
            return response()->json(
                [
                    'message' => 'User not found!',
                ], 404);
        }

    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->delete()) {
                return response()->json(
                    [
                        'message' => 'Successfully deleted user!',
                        'user' => $user
                    ], 200);
            } else {
                return response()->json(
                    [
                        'message' => 'Something went wrong on delete user',
                        'user' => $user
                    ], 500);
            }

        } else {
            return response()->json(
                [
                    'message' => 'User not found!',
                ], 404);
        }

    }


}
