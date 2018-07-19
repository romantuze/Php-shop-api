<?php
namespace api\models;

use core\Model;

class Products extends Model
{

    public function productsJson($products)
    {
        $products_arr = [];
        foreach ($products as $product) {
            $product_item = [
                "id"           => $product["id"],
                "name"         => $product["name"],
                "stock"        => $product["stock"],
                "price"        => $product["price"],
                "manufacturer" => $product["manufacturer"],
                "description"  => html_entity_decode($product["description"]),
                "content"      => html_entity_decode($product["content"]),
                "created"      => $product["created"],
            ];
            $products_arr[] = $product_item;
        }
        return json_encode($products_arr);
    }

    public function readOne($id)
    {
        $params = [
            'id' => $id,
        ];
        $result = $this->db->row('SELECT * FROM `products` WHERE id = :id', $params);
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

    public function readAll()
    {
        $result = $this->db->row('SELECT * FROM `products`');
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

    public function readCategory($catid)
    {
        $resultId = $this->db->row("SELECT * FROM `products_categories` WHERE category_id = :catid", ['catid' => $catid]);
        if ($resultId) {
            foreach ($resultId as $resultKey) {
                $resultIds[] = (int) $resultKey['product_id'];
            }
            $resultIds = implode(", ", $resultIds);
        } else {
            return false;
        }
        $result = $this->db->row("SELECT * FROM `products` WHERE id IN ($resultIds)");
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

    private function getInnerCategories($cats, $parent_id, $only_parent = false)
    {
        if (is_array($cats) and isset($cats[$parent_id])) {
            $getCategoriesArray = '';
            if ($only_parent == false) {
                foreach ($cats[$parent_id] as $cat) {
                    $getCategoriesArray .= $cat['category_id'] . ',';
                    $getCategoriesArray .= $this->getInnerCategories($cats, $cat['category_id']);
                }
            } elseif (is_numeric($only_parent)) {
                $cat = $cats[$parent_id][$only_parent];
                $getCategoriesArray .= $cat['category_id'] . ',';
                $getCategoriesArray .= $this->getInnerCategories($cats, $cat['category_id']);
            }
        } else {
            return null;
        }
        $getCategoriesArray = mb_substr($getCategoriesArray, 0, -1);
        return $getCategoriesArray;
    }

    public function readCategoryAll($catid)
    {

        $categories      = $this->db->row("SELECT category_id, parent_id FROM  `categories`");
        $categoriesArray = [];
        foreach ($categories as $category) {
            $categoriesArray[$category["parent_id"]][$category["category_id"]] = $category;
        }
        $categoriesStr = $this->getInnerCategories($categoriesArray, 0, $catid);
        $resultId      = $this->db->row("SELECT * FROM  `products_categories` WHERE category_id IN ({$categoriesStr})");
        if ($resultId) {
            foreach ($resultId as $resultKey) {
                $resultIds[] = (int) $resultKey['product_id'];
            }
            $resultIds = implode(", ", $resultIds);
        } else {
            return false;
        }
        $result = $this->db->row("SELECT * FROM `products` WHERE id IN ({$resultIds})");
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

    public function readManafacturer($m)
    {
        $m      = (string) isset($m) ? $m : "";
        $mArray = explode("&", $m);
        $query  = "SELECT * FROM `products` WHERE manufacturer = '{$mArray[0]}'";
        for ($i = 1; $i < count($mArray); $i++) {
            $query .= " OR manufacturer ='{$mArray[$i]}'";
        }
        $result = $this->db->row($query);
        //var_dump($query); die;
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

    public function readSearch($s)
    {
        $keywords = (string) isset($s) ? $s : "";
        $result   = $this->db->row("SELECT * FROM `products` WHERE name LIKE '%{$keywords}%' ORDER BY created DESC");
        if ($result) {
            $products = $this->productsJson($result);
            return $products;
        } else {
            return false;
        }
    }

}
