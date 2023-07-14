<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\WeekDay;
use App\Entity\Category;
use App\Entity\Services;
use App\Entity\OpenHours;
use App\Entity\Testimonials;
use App\Entity\ImageCollection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $faker = Factory::create();
        //==========MARQUES
        $brandArray = ["Peugeot","Citroen","Twingo","BMW","Toyota"];
        for ($i=0; $i < count($brandArray); $i++) {
            $brand = new Brand;
            $brand->setBrand($brandArray[$i]);
            $manager->persist($brand);
        }
        
        //=========CATEGORIES
        $category1 = new Category;
        $category1->setCategory("Essence");
        $manager->persist($category1);
        $category2 = new Category;
        $category2->setCategory("Diesel");
        $manager->persist($category2);
        
        $manager->flush();
        //=========VOITURES
        $categoryArray = $manager->getRepository(Category::class)->findAll();
        $brandArray = $manager->getRepository(Brand::class)->findAll();
        
        for ($i = 0; $i < 20; $i++) {
            $car = new Car;
            $car->setCategory($categoryArray[rand(0, count($categoryArray) - 1)]);
            $car->setBrand($brandArray[rand(0, count($brandArray) - 1)]);
            $car->setName($faker->words(1, true));
            $car->setPrice($faker->randomDigitNot(0)*1000);
            $car->setYearPlacedInCirculation($faker->year());
            $car->setMileage($faker->randomDigitNot(0) * 1000);
            $car->setDescription($faker->sentence(1, true));
        
            $imagesArray = [
                "Peugeot-3008-GT-2021__01.jpg",
                "Peugeot-3008-GT-2021__02.jpg",
                "Peugeot-3008-GT-2021__03.jpg"
            ];
        
            foreach ($imagesArray as $imageUrl) {
                $images = new ImageCollection;
                $images->setImageUrl($imageUrl);
                $car->addImageCollection($images);
                $manager->persist($images);
            }
        
            $manager->persist($car);
        }
            
            
            //===========SERVICES
            for ($i=0; $i < 4; $i++) { 
                $service = new Services;
                $service->setName($faker->word());
                $service->setDescription($faker->sentence(3,true));
                $service->setpicture_src("car-service-name.jpg");
                $manager->persist($service);
            }
            
            
            //===========TEMOIGNAGES
            for ($i=0; $i < 5; $i++) { 
                $testimonial = new Testimonials;
                $testimonial->setName($faker->firstName());
                $testimonial->setSurname($faker->lastName());
                $testimonial->setMessage($faker->sentence(3,true));
                $testimonial->setNote($faker->numberBetween(0,10));
                $testimonial->setPendingVerification(1);
                $testimonial->setIsValidated(0);
                $manager->persist($testimonial);
            }
            
            
            //===========HORAIRES
            $dayArray = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
            foreach ($dayArray as $day) {
                
                $weekday = new WeekDay;
                $weekday->setDay($day);
                
                $openHours = new OpenHours;
                $openHours->setStartTime($faker->dateTime());
                $openHours->setEndTime($faker->dateTime());
                $openHours->setIsClosed(0);
                $weekday->setOpenHours($openHours);
                
                $manager->persist($weekday);
                $manager->persist($openHours);
            }
            
            // $user = new User;
            // $user->setName("Vincent");
            // $user->setSurname("Parrot");
            // $user->setEmail("admin@admin.fr");
            // $user->setPassword("Admin123");
            // $user->setRoles(["ROLE_ADMIN"]);
            // $manager->persist($user);

            // $user = new User;
            // $user->setName("Employé");
            // $user->setSurname("Test");
            // $user->setEmail("employé@test.fr");
            // $user->setPassword("Admin123");
            // $user->setRoles(["ROLE_EMPLOYEE"]);
            // $manager->persist($user);

        $manager->flush();
    }
}
