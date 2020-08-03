<?php


class Shop
{

    public function sortByColor($color)
    {
        $color = $_GET['colorName'];
        $model = new ProductModel();
        $colorProducts = $model->getDiceByColor($color);

        echo json_encode($colorProducts);
        exit();
    }

    public static function CreateView()
    {

        $model = new ProductModel();
        $products = $model->getProductList();
        $colors = $model->getColorList();
        $newest = $model->getNewestList();

        $variables = compact('products', 'colors', 'newest');

        Utils::render('Shop', $variables);
    }
}
