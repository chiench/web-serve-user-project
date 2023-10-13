<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Product::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 10, 100), // Giá sản phẩm ngẫu nhiên từ 10 đến 100 với 2 chữ số thập phân.
            'image' => $this->generateUrlImage($this->faker->numberBetween(1, 48)), // URL của hình ảnh ngẫu nhiên.
            // 'images' => $this->faker->words(3, true), // 3 từ ngẫu nhiên, có thể cần điều chỉnh để phù hợp với cấu trúc thực tế của bạn.
        ];
    }
    public function generateUrlImage($count)
    {
        $urlImage = "";
        if ($count < 33) {
            if ($count > 16) {
                $urlImage = "/product-" . (33 - $count) . '-2.jpg';
            } else {
                $urlImage = "/product-" . $count . "-1.jpg";
            }
        } elseif ($count < 41 && $count >= 33) {
            $urlImage = "/category-thumb-" . (41 - $count) . ".jpg";
        } elseif ($count < 49 && $count >= 41) {
            $urlImage = "/thumbnail-" . (50 - $count) . ".jpg";
        }
        return $urlImage;
    }

    // public function generateUrlImage()
    // {
    //     $count = 0;
    //     $urlImage = "";
    //     if ($count < 31) {
    //         i
    //         $urlImage = public_path("product") . "/" . $randomOption . "-" . $count . "-" . $this->faker->numberBetween(1, 2) . '.jpg';
    //     } elseif ($count > 22) {

    //     } elseif ($count < 28) {

    //     }
    //     $count++;
    //     return $urlImage

    //     $options = ["category-thumb-", "thumbnail-", "product"];
    //     $randomOption = $options[array_rand($options)];
    //     $urlImage = "";
    //     switch ($randomOption) {
    //         case 'category-thumb-':
    //             $urlImage = public_path("product") . "/" . $randomOption . $this->faker->numberBetween(1, 8) . '.jpg';
    //             break;

    //         case 'thumbnail-':
    //             $urlImage = public_path("product") . "/" . $randomOption . $this->faker->numberBetween(2, 9) . '.jpg';
    //             break;
    //         case 'product':
    //             $urlImage = public_path("product") . "/" . $randomOption . "-" . $this->faker->numberBetween(1, 16) . "-" . $this->faker->numberBetween(1, 2) . '.jpg';
    //             break;
    //     }
    //     dd($urlImage);

    //     return $urlImage;
    // }
}
