<?php

class ItemController extends \BaseController {

	/**
	 * Display the HTML page of the user's packing list.
	 *
	 * @return Response
	 */
	public function listPage()
	{
        $items = Auth::user()->items;
        return View::make('item.index', array('items' => $items));
	}

	/**
	 * Return the JSON representation of the user's packing list.
	 *
	 * @return Response
	 */
	public function index()
	{
        $items = Auth::user()->items;
        return Response::json($items);
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
        return Response::json($item);
	}

	/**
	 * Update the specified Item in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $item = Auth::user()->items()->where('id', $id)->first();

        if ($item) {
            $item->name = Input::get('name', $item->name);
            $item->packed = Input::get('packed', $item->packed);
            $item->save();

            return Response::json($item);
        } else {
            App::abort(500, 'Item not found or access denied.');
        }
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
            return Response::json(null);
        } else {
            App::abort(500, 'Item not found or access denied.');
        }
	}

    /**
     * Create a new Item and add it to the logged-in user's Items.
     * 
     * @access public
     * @return Response
     */
    public function store()
    {
        $name = Input::only('name');
        $item = new Item($name);

        Auth::user()->items()->save($item);

        return Response::json($item);
    }

}
