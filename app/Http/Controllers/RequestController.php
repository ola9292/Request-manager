<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8001/api/items');

      //to get array format
      $items = json_decode($response->getBody()->getContents());
      return view('pages.index',[
        'items' => $items,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'body' => 'required',
        ]);
        $client = new Client();

        try {
            $response = $client->post('http://127.0.0.1:8001/api/items?text='.$request->input('text').'&body='.$request->input('body'));
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                $msg = $e->getResponse();
            } else {
                $msg = 'The item could not be inserted.';
            }
            return redirect()->to('/request')->with('error', $msg);
        }

        return redirect()->to('/request')->with('success', 'Item inserted successfully!');
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

        $client = new Client();

        $reponse = $client->get('http://127.0.0.1:8001/api/items/'.$id);

        $item = json_decode($reponse->getBody()->getContents());

        return view('pages.edit',[
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'text' => 'required',
            'body' => 'required',
        ]);
        $client = new Client();

        try {
            $response = $client->post('http://127.0.0.1:8001/api/items/'.$id.'?text='.$request->input('text').'&body='.$request->input('body').'&_method=PUT');
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                $msg = $e->getResponse();
            } else {
                $msg = 'The item could not be updated.';
            }
            return redirect()->to('/request')->with('error', $msg);
        }

        return redirect()->to('/request')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();

        $response = $client->post('http://127.0.0.1:8001/api/items/'.$id.'?_method=DELETE');

        $contents = json_decode($response->getBody()->getContents());
        // dd($response->getStatusCode());
        $success = $contents->success;

        if ($response->getStatusCode() == 200){
            return redirect()->to('/request')->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->to('/request')->with('error', 'Item could not be deleted');
        }
    }
}
