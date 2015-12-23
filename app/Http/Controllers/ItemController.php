<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Auth;
use Illuminate\Http\Request;

class ItemController extends Controller {

    /**
     * Display the HTML page of the user's packing list.
     *
     * @return Response
     */
    public function listPage()
    {
        $items = Auth::user()->items;
        return view('item.index', array('items' => $items));
    }

    /**
     * Return the JSON representation of the user's packing list.
     *
     * @return Response
     */
    public function index()
    {
        $items = Auth::user()->items;
        return response()->json($items);
    }

    /**
     * Return the JSON representation of the specified Item if it exists and
     * the current user owns it.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Auth::user()->items()->where('id', $id)->first();
        return response()->json($item);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $item = Auth::user()->items()->where('id', $id)->first();

        if ($item) {
            $newItemData = [
                'name' => trim($request->input('name', $item->name)),
                'packed' => $request->input('packed', $item->packed),
            ];

            $validator = $item->getValidator($newItemData);
            if ($validator->fails()) {
                return response()->json(['usermessage' => 'Item is invalid'], 500);
            }

            $item->name = $newItemData['name'];
            $item->packed = $newItemData['packed'];
            $success = $item->save();

            if ($success) {
                return response()->json($item);
            } else {
                return response()->json(['usermessage' => 'Could not save item'], 500);
            }

        } else {
            App::abort(500, 'Item not found or access denied.');
        }
    }

    /**
     * Set all of the user's Items to unpacked.
     * 
     * @access public
     * @return Response
     */
    public function unpackAll()
    {
        $items = Auth::user()->items;

        foreach($items as $item) {
            $item->packed = false;
            $item->save();
        }

        return response()->json($items);
    }

    /**
     * Remove the specified Item from the DB if it exists and the current
     * user owns it.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Auth::user()->items()->where('id', $id)->first();

        if ($item) {
            $item->delete();
            return response()->json(null);
        } else {
            App::abort(500, 'Item not found or access denied.');
        }
    }

    /**
     * Create a new Item and add it to the logged-in user's Items.
     * 
     * @access public
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasMaxItems()) {
            return response()->json(['usermessage' => 'You already have the maximum number of items in your list'], 500);
        }

        $itemData = [
            'name' => trim($request->input('name')),
        ];

        $item = new Item($itemData);

        $validator = $item->getValidator($itemData);
        if ($validator->fails()) {
            return response()->json(['usermessage' => 'Item is invalid'], 500);
        }

        $success = Auth::user()->items()->save($item);

        if ($success) {
            return response()->json($item);
        } else {
            return response()->json(['usermessage' => 'Could not save item'], 500);
        }
    }

}
