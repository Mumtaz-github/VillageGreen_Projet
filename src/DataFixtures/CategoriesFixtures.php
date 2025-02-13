<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    public function __construct(private SluggerInterface $sluggger){}
    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Guitars & Basses', 'Guitars_&_Bases.png', null, $manager);

        //sous categories Guitars
        $this->createCategory('Acoustic G', 'Acoustic_G_4.png', $parent, $manager);
        $this->createCategory('Classical G', 'Classical_G_2.png', $parent, $manager);
        $this->createCategory('Electri G', 'Electric_G_1.png', $parent, $manager);
        


        $parent = $this->createCategory('Drums & Percussion', 'Drums_&_Percussion.png', null, $manager);

        //sous categories Drums & Percussion
        $this->createCategory('Acoustic Drums', 'AcousticDrums-01.webp', $parent, $manager);
        $this->createCategory('Percussion', 'Percussion-03.webp', $parent, $manager);
        $this->createCategory('Electronic Drum', 'ElectronicDrum-02.webp', $parent, $manager);


        $parent = $this->createCategory('Keys', 'Keys.png', null, $manager);

        //sous categories Keys
        $this->createCategory('Acoustic G', 'Acoustic_G_4.png', $parent, $manager);
        $this->createCategory('Classical G', 'Classical_G_2.png', $parent, $manager);
        $this->createCategory('Electri G', 'Electric_G_1.png', $parent, $manager);


        $parent = $this->createCategory('Lighting & Stage', 'Lighting_&_Stage.jpg', null, $manager);

        //sous categories Lighting & Stage
        $this->createCategory('Acoustic G', 'Acoustic_G_4.png', $parent, $manager);
        $this->createCategory('Classical G', 'Classical_G_2.png', $parent, $manager);
        $this->createCategory('Electri G', 'Electric_G_1.png', $parent, $manager);



        $parent = $this->createCategory('PA Equipment', 'PA_Equipment.png', null, $manager);

        //sous categories PA Equipment
        $this->createCategory('Acoustic G', 'Acoustic_G_4.png', $parent, $manager);
        $this->createCategory('Classical G', 'Classical_G_2.png', $parent, $manager);
        $this->createCategory('Electri G', 'Electric_G_1.png', $parent, $manager);

        $parent = $this->createCategory('Wind Instruments', 'Wind_Instruments.jpg', null, $manager);

        //sous categories Wind Instruments
        $this->createCategory('Acoustic G', 'Acoustic_G_4.png', $parent, $manager);
        $this->createCategory('Classical G', 'Classical_G_2.png', $parent, $manager);
        $this->createCategory('Electri G', 'Electric_G_1.png', $parent, $manager);

        $manager->flush();
    }
    public function createCategory(string $name, Categories $parent = null, ObjectManager $manager){

        $category = new Categories();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);
        return $category;
    }
}
