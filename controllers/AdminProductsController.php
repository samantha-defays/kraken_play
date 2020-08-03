<?php

class AdminProducts
{

    public function deleteArticle($id)
    {
        $model = new ProductModel();
        $model->deleteProduct($id);

        header('Location: ./admin-products');
        exit();
    }

    public static function CreateView()
    {

        $model = new ProductModel();
        $products = $model->getProductList();

        $variables = compact('products');

        Utils::render('AdminProducts', $variables);
    }
}
