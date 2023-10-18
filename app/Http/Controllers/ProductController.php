<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class ProductController extends Controller
{
    private $productService;
    private $logger;

    public function __construct(ProductService $productService, LoggerInterface $logger)
    {
        $this->productService = $productService;
        $this->logger = $logger;
    }

    public function index()
    {
        try {
            $products = $this->productService->getProductAll();
            $perPage = 10; 
            $currentPage = Paginator::resolveCurrentPage('page');
            $productsCollection = collect($products); 
            $pagedData = $productsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $products = new LengthAwarePaginator($pagedData, count($productsCollection), $perPage, $currentPage, [
                'path' => Paginator::resolveCurrentPath(),
            ]);
            return view('products.index', ["products" => $products]);
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
        
    }
    public function create()
    {
        try {
            return view('products.form');
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
    public function store(Request $request)
    {
        try {
            $product = $this->productService->createProduct($request);
            return redirect('/product');
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->productService->getProductOne($id);
            return view('products.form', ["product" => $product]);
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

  

    public function update($id, Request $request)
    {
        try {
            $result = $this->productService->editProduct($id, $request);
            return redirect('/product');
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->productService->deleteProduct($id);
            return redirect('/product');
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    private function logError(Exception $exception)
    {
        $this->logger->error('Erro no controlador ProductController', [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
