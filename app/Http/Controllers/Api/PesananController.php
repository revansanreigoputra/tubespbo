<?php

namespace App\Http\Controllers\Api;

//import model Pesanan
use App\Models\Pesanan;

//import resource PesananResource
use App\Http\Resources\PesananResource;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all pesanan
        $pesanan = Pesanan::latest()->paginate(5);

        //return collection of pesanan as a resource
        return new PesananResource(true, 'List Data Pesanan', $pesanan);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string',
            'harga_tiket'     => 'required|integer',
            'jumlah_tiket'    => 'required|integer',
            'total_harga'     => 'required|integer',
        ]);
        
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        //calculate total price
        $total_harga = $request->harga_tiket * $request->jumlah_tiket;

        //create pesanan
        $pesanan = Pesanan::create([
            'nama'            => $request->nama,
            'harga_tiket'     => $request->harga_tiket,
            'jumlah_tiket'    => $request->jumlah_tiket,
            'total_harga'     => $total_harga,
        ]);

        //return response
        return new PesananResource(true, 'Data Pesanan Berhasil Ditambahkan!', $pesanan);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find pesanan by ID
        $pesanan = Pesanan::find($id);

        //check if pesanan exists
        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan not found'], 404);
        }

        //return single pesanan as a resource
        return new PesananResource(true, 'Detail Data Pesanan!', $pesanan);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string',
            'harga_tiket'     => 'required|integer',
            'jumlah_tiket'    => 'required|integer',
            'total_harga'     => 'required|integer',
        ]);
        
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find pesanan by ID
        $pesanan = Pesanan::find($id);

        //check if pesanan exists
        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan not found'], 404);
        }

        //calculate total price
        $total_harga = $request->harga_tiket * $request->jumlah_tiket;

        //update pesanan
        $pesanan->update([
            'nama'            => $request->nama,
            'harga_tiket'     => $request->harga_tiket,
            'jumlah_tiket'    => $request->jumlah_tiket,
            'total_harga'     => $total_harga,
        ]);

        //return response
        return new PesananResource(true, 'Data Pesanan Berhasil Diubah!', $pesanan);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find pesanan by ID
        $pesanan = Pesanan::find($id);

        //check if pesanan exists
        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan not found'], 404);
        }

        //delete pesanan
        $pesanan->delete();

        //return response
        return new PesananResource(true, 'Data Pesanan Berhasil Dihapus!', null);
    }
}
