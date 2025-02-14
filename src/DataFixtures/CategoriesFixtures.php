<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
{
    $parent = $this->createCategory('Guitars & Basses', 'imag_categories/guitarsBases.png', null, $manager);

    // Subcategories for Guitars
    $this->createCategory('G Electriques', 'imag_categoris/sous_categories/gElectrique1.webp', $parent, $manager);
    $this->createCategory('G Classiques', 'imag_categoris/sous_categories/gClassique.webp', $parent, $manager);
    $this->createCategory('G Ukuleles', 'imag_categoris/sous_categories/gUkuleles3.webp', $parent, $manager);

    $parent = $this->createCategory('Batteris & Percussion', 'imag_categories/batterisPercussion.png', null, $manager);

    // Subcategories for Drums & Percussion
    $this->createCategory('B Acoustiques', 'imag_categoris/sous_categories/Bacoustic1.webp', $parent, $manager);
    $this->createCategory('B Electroniques', 'imag_categoris/sous_categories/BElectroniques2.webp', $parent, $manager);
    $this->createCategory('B Percussion', 'imag_categoris/sous_categories/Bercussion3.webp', $parent, $manager);

    $parent = $this->createCategory('Pianos & Claviers', 'imag_categories/pianoClavier.png', null, $manager);

    // Subcategories for Keys
    $this->createCategory('Pianos Queue', 'imag_categoris/sous_categories/PQueue1.webp', $parent, $manager);
    $this->createCategory('Accordeons', 'imag_categoris/sous_categories/PCMaitres2.webp', $parent, $manager);
    $this->createCategory('Pianos Droits', 'imag_categoris/sous_categories/PDroits3.webp', $parent, $manager);

    $parent = $this->createCategory('Lumiere & Scene', 'imag_categories/lumiereScene.jpg', null, $manager);

    // Subcategories for Lighting & Stage
    $this->createCategory('Set Projecteurs', 'imag_categoris/sous_categories/lProjecteurs1.webp', $parent, $manager);
    $this->createCategory('Projectures', 'imag_categoris/sous_categories/lProjectures2.webp', $parent, $manager);
    $this->createCategory('P Robotises', 'imag_categoris/sous_categories/lProjecturesR.webp', $parent, $manager);

    $parent = $this->createCategory('Sonorisation', 'imag_categories/sonorisation.png', null, $manager);

    // Subcategories for PA Equipment
    $this->createCategory('Set Sonorisation', 'imag_categoris/sous_categories/Scomplets1.webp', $parent, $manager);
    $this->createCategory('Enceintes Sonorisation', 'imag_categoris/sous_categories/Senceintes2.webp', $parent, $manager);
    $this->createCategory('Microphones', 'imag_categoris/sous_categories/Smicrophones3.webp', $parent, $manager);

    $parent = $this->createCategory('Instruments Vent', 'imag_categories/instrumentsVent.jpg', null, $manager);

    // Subcategories for Wind Instruments
    $this->createCategory('V Clarinettes', 'imag_categoris/sous_categories/vClarinettes3.webp', $parent, $manager);
    $this->createCategory('V Trompettes', 'imag_categoris/sous_categories/vTrompettes2.webp', $parent, $manager);
    $this->createCategory('Saxophones', 'imag_categoris/sous_categories/vSaxophones1.webp', $parent, $manager);

    $manager->flush();
}
    public function createCategory(string $name, string $url_photo = null, Categories $parent = null, ObjectManager $manager): Categories
    {
        $category = new Categories();
        $category->setNom($name);
        $category->setSlug($this->slugger->slug($category->getNom())->lower());
        $category->setParent($parent);
        
        // Set the image URL if provided
        if ($url_photo) {
            $category->setUrlPhoto($url_photo);
        }
    
        $manager->persist($category);
    
        return $category;
    }
}