<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $players = Player::orderBy('id', 'desc')->paginate(10);

        return view ('pages.players.index', ['players' => $players]);
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        //Search in the title and body columns from the posts table
        $players = ($request->search) ?
            Player:: where('name', 'LIKE', "%{$search}%")->paginate(15) :
            Player::orderby('id', 'desc')->paginate(15);

        // Return the search view with the results compacted
        return view ('pages.players.search', ['players' => $players]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pages.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'address'       => 'required',
            'description'   => 'required',
            'retired'       => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /*Player::create([
            'name'          => $request->name,
            'address'       => $request->address,
            'description'   => $request->description,
            'retired'       => $request->retired,

        ]);*/

        $player = new Player();
        $player->name           = $request->name;
        $player->address        = $request->address;
        $player->description    = $request->description;
        $player->retired        = $request->retired;
        $player->save();

        //If we have an image file, we store it, and move it in the database
        if ($request->file('image')) {

            // Get Image File
            $imagePath = $request->file('image');

            // Define Image Name
            $imageName =  $player->id . '_' .  time() . '_' .  $imagePath->getClientOriginalName();

            // Save Image on Storage
            $path = $request->file('image')->storeAs('images/players/' . $player->id, $imageName, 'public');

            //Save Image Path
            $player->image = $path;
            $player->save();
        }

        return redirect('players')->with('status','Item created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view ('pages.players.show', ['player' => $player]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {


        return view ('pages.players.edit', ['player' => $player]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $player                 = Player::find($player->id);
        $player->name           = $request->name;
        $player->address        = $request->address;
        $player->description    = $request->description;
        $player->retired        = $request->retired;
        $player->save();

        if($player->image == null){
            if ($request->file('image')) {

                // Get Image File
                $imagePath = $request->file('image');

                // Define Image Name
                $imageName =  $player->id . '_' .  time() . '_' .  $imagePath->getClientOriginalName();

                // Save Image on Storage
                $path = $request->file('image')->storeAs('images/players/' . $player->id, $imageName, 'public');

                //Save Image Path
                $player->image = $path;
                $player->save();
            }
        }else{
            if ($request->file('image')) {

                Storage::deleteDirectory('public/images/players/' . $player->id);
                // Get Image File
                $imagePath = $request->file('image');

                // Define Image Name
                $imageName =  $player->id . '_' .  time() . '_' .  $imagePath->getClientOriginalName();

                // Save Image on Storage
                $path = $request->file('image')->storeAs('images/players/' . $player->id, $imageName, 'public');

                //Save Image Path
                $player->image = $path;
                $player->save();
            }
        }

        return redirect('players')->with('status','Item edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player = Player::find($player->id);

        Storage::deleteDirectory('public/images/players/' . $player->id);
        //Storage::delete('public/' . $player->image);
        $player->delete();

        return redirect('players')->with('status','Item deleted successfully');

    }
}
