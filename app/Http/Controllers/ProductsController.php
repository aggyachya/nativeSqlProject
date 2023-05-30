<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    // CREATE DATA
    public function store(Request $request)
    {
        $judul = $request->judul;
        $harga = $request->harga;
        $jumlah = $request->jumlah;
        $penulis = $request->penulis;

        DB::insert('INSERT INTO products (judul, harga, jumlah, penulis) VALUES (?, ?, ?, ?)', [
            $judul ?? null,
            $harga ?? null,
            $jumlah ?? null,
            $penulis ?? null
        ]);

        return "Product added successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }

    // READ DATA
    public function index()
    {
        $products = DB::select('SELECT * FROM products');

        return view('products.index', ['products' => $products]);
    }

    // UPDATE DATA
    public function edit($id)
    {
        $product = DB::select('SELECT * FROM products WHERE id = ?', [$id])[0] ?? null;

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $judul = $request->input('judul');
        $harga = $request->input('harga');
        $jumlah = $request->input('jumlah');
        $penulis = $request->input('penulis');

        DB::update('UPDATE products SET judul = ?, harga = ?, jumlah = ?, penulis = ? WHERE id = ?', [$judul, $harga, $jumlah, $penulis, $id]);

        return "Product updated successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }

    // DELETE DATA
    public function delete($id)
    {
        DB::delete('DELETE FROM products WHERE id = ?', [$id]);

        return "Product deleted successfully. <a href='" . route('products.index') . "'>View Products</a>";
    }
}
