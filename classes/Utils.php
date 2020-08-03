<?php
class Utils
{

    public static function render(string $path, array $variables = [])
    {

        extract($variables);

        ob_start();
        require("./Views/$path.phtml");
        $pageContent = ob_get_clean();

        // Admin pages to determine which layout to use
        $adminPages = ['Admin', 'AdminProducts', 'AdminOrders', 'AdminProductManager', 'AdminProductEditor', 'AdminUsers', 'AdminEvents', 'AdminEventManager', 'AdminEventEditor'];

        if (in_array($path, $adminPages)) {
            require("./Views/AdminLayout.phtml");
        } else {
            require("./Views/Layout.phtml");
        }
    }
}
