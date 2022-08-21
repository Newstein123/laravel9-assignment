<?php 

namespace App\Interfaces;

interface CategoryRepositoryInterface {
    public function getAllCategory();
    public function getCategoryById($id);
    public function deleteCategory($id);
    public function createCategory(array $category);
    public function updateCategory($id, array $category);
}