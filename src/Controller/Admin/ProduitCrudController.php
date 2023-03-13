<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Doctrine\DBAL\Types\BlobType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use phpDocumentor\Reflection\PseudoTypes\False_;
use PhpParser\Node\Expr\Yield_;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
          TextField::new('nom'),
          SlugField::new('slug')->setTargetFieldName('nom'),
          ImageField::new('image')
          ->setBasePath('public/uploads/images/') 
          -> setUploadDir('public/uploads/images/')
          ->setUploadedFileNamePattern('[randomhash].[extension] ')
          ->setRequired(False),
          TextField::new('subtitle'),
          TextareaField::new('description'),
          AssociationField::new('category'),
          MoneyField::new('prix')->setCurrency('XOF'),
        

        ];
    }
    
}