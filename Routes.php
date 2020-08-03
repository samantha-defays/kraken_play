<?php

// ROUTES DECLARATIONS

Route::set('index.php', function () {
    Home::CreateView();
});

Route::set('shop', function () {
    Shop::CreateView();
});

Route::set('product-detail', function () {
    ProductDetail::CreateView();
});

Route::set('custom', function () {
    Custom::CreateView();
});

Route::set('register', function () {
    Register::CreateView();
});

Route::set('events', function () {
    Events::CreateView();
});

Route::set('contact', function () {
    Contact::CreateView();
});

Route::set('login', function () {
    Login::CreateView();
});

Route::set('logout', function () {
    Logout::loggingOut();
});

Route::set('admin', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        Admin::CreateView();
    }
});

Route::set('cart', function () {
    Cart::CreateView();
});

Route::set('validation', function () {
    Validation::CreateView();
});

// ADMIN PAGES
Route::set('admin-products', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminProducts::CreateView();
    }
});

Route::set('admin-product-manager', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminProductManager::CreateView();
    }
});

Route::set('admin-product-edit', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminProductEditor::CreateView();
    }
});

Route::set('admin-orders', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminOrders::CreateView();
    }
});

Route::set('admin-users', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminUsers::CreateView();
    }
});

Route::set('admin-events', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminEvents::CreateView();
    }
});

Route::set('admin-event-manager', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminEventManager::CreateView();
    }
});

Route::set('admin-event-edit', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        AdminEventEditor::CreateView();
    }
});

// VIEW-LESS URL
//fictive route to generate the list of dice sorted by color
Route::set('ajax-color', function () {
    $ajax = new Shop();
    $ajax->sortByColor($_GET['colorName']);
});

// fictive route to delete a product from the admin-page
Route::set('delete-product', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        $delete = new AdminProducts();
        $delete->deleteArticle($_GET['id']);
    }
});

// fictive route to delete an event from the admin-page
Route::set('delete-event', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rank'] != 'Admin') {
        Login::CreateView();
    } else {
        $delete = new AdminEvents();
        $delete->deleteEvent($_GET['id']);
    }
});

// fictive route to empty the shopping cart
Route::set(
    'empty-cart',
    function () {
        $cart = new Cart();
        $cart->emptyCart();
    }
);

// fictive route to signup for an event
Route::set('event-participate', function () {
    if (empty($_SESSION['user'])) {
        Login::CreateView();
    } else {
        try {
            $event = new Events;
            $event->registerToEvent($_GET['id']);
        } catch (Exception $e) {
            header("Refresh: 5;URL=./events");
            echo "Vous êtes déjà inscrit à cet événement. Vous allez être automatiquement redirigé vers le site.";
        }
    }
});
