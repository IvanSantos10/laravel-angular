<?php

namespace Projeto\Http\Controllers;

use Illuminate\Http\Request;

use Projeto\Entities\Client;
use Projeto\Http\Requests;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    public function update(Request $request, $id)
    {
        Client::whereId($id)->update($request->all());
        return $this->show($id);
    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function destroy($id)
    {
        if(Client::find($id)->delete()){
            return 'Deletado com sucesso';
        }

        return 'Erro ao deletar';
    }
}
