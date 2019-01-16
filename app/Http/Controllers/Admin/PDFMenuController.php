<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMessage;
use App\Http\Controllers\Controller;
use App\PDFMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food_menu = PDFMenu::where('type', 'food')->first();
        $beer_menu = PDFMenu::where('type', 'beer')->first();
        return view('pdfs.index', compact('food_menu', 'beer_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $path = $file->storeAs('public/menus', $file->getClientOriginalName());
            PDFMenu::create([
                'type'     => $request->type,
                'size'     => $file->getClientSize(),
                'filename' => $file->getClientOriginalName(),
                'filepath' => $path,
                'filetype' => $file->getClientMimeType()
            ]);

            FlashMessage::success('Your menu has been uploaded!');
        }
        else {
            FlashMessage::danger('Oops! There was a problem uploading your file');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pdf = PDFMenu::findOrFail($id);
        if (Storage::has($pdf->filepath)) {
            Storage::delete($pdf->filepath);
            $pdf->delete();
            FlashMessage::success($pdf->filename . ' deleted!');
        }
        else {
            FlashMessage::danger($pdf->filename. ' was not found on disk. Try uploading a new file.');
        }

        return redirect()->back();
    }
}
