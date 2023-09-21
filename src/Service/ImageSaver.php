<?php
namespace App\Service;

use Exception;
use App\Entity\Car;
use App\Entity\Services;
use App\Entity\ImageCollection;
use Doctrine\Common\Cache\Psr6\InvalidArgument;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageSaver
{
    private $appServiceParameters;
    private EntityManagerInterface $em;

    public function __construct(ParameterBagInterface $appServiceParameters,EntityManagerInterface $em)
    {
        $this->appServiceParameters = $appServiceParameters;
        $this->em = $em;
    }

    public function persistImageArray(array  $uploadedFiles, Car | Services $entity)
    {
        
        foreach ($uploadedFiles as $uploadedFile) {
            
            //on vérifie que le fichier est bien le type attendu
            if($this->validateUpload($uploadedFile) && $this->validateExtension($uploadedFile));
                
            // crée un nom de fichier utilisable 
            $newFileName = uniqid().'.'.$uploadedFile->guessExtension();
            
            // on déplace le fichier dans le dossier choisi
            if ($entity instanceof Car) {
                

                $this->persistCar($uploadedFile,$entity,$newFileName);

            }elseif($entity instanceof Services){
                
                $this->persistService($uploadedFile,$entity,$newFileName);
            
            }else{

                throw new InvalidArgument("Entity is neither a Car or Service Entity");
            } 
        }
    }
    public function persistImage(UploadedFile $uploadedFile, Car | Services $entity)
    {
        //on vérifie que le fichier est bien le type attendu
        if($this->validateUpload($uploadedFile) && $this->validateExtension($uploadedFile));
            
        // crée un nom de fichier utilisable 
        $newFileName = uniqid().'.'.$uploadedFile->guessExtension();
        
        // on déplace le fichier dans le dossier choisi
        if ($entity instanceof Car) {
            

            $this->persistCar($uploadedFile,$entity,$newFileName);

        }elseif($entity instanceof Services){
            
            $this->persistService($uploadedFile,$entity,$newFileName);
        
        }else{

            throw new InvalidArgument("Entity is neither a Car or Service Entity");
        } 
        
    }

    private function validateUpload(UploadedFile $uploadedFile)
    {
        if (!$uploadedFile instanceof UploadedFile) {
            throw new InvalidArgumentException("Waiting for Instance of UploadedFile class, received : ".$uploadedFile);
        }else{
            return true;
        }
    }

    private function validateExtension(UploadedFile $uploadedFile)
    {
        //extensions autorisés
        $extensionsArray = ["jpg","png","webp","jpeg"];

        $fileExtension =  $uploadedFile->guessExtension();

        if (!in_array($fileExtension,$extensionsArray)) {
            throw new Exception("File extension not allowed, accepted file extensions are : ".implode(",",$extensionsArray));
        }else{
            return true;
        }
    }

    public function persistCar(UploadedFile $uploadedFile, Car $entity, $newFileName)
    {
        try{
            $uploadedFile->move(
                //services.yaml sous parameters
                $this->appServiceParameters->get('image_directory'),
                $newFileName
            );
        }catch (FileException $e){
            return new $e(`Une erreur c'est produite durant
            l'envoie de fichier` ,400 );
        }
        // ajout du slug à la table image collection
        // et liaison avec l'entité enregistré
        $imageCollection = new ImageCollection;
        $imageCollection->setImageUrl($newFileName);
        $entity->addImageCollection($imageCollection);
        
        $this->em->persist($imageCollection);
    }

    public function persistService(UploadedFile $uploadedFile, Services $entity, $newFileName)
    {
        try{
            $uploadedFile->move(
                //services.yaml sous parameters
                $this->appServiceParameters->get('service_directory'),
                $newFileName
            );
            $entity->setpicture_src($newFileName);

            $this->em->getRepository(Services::class)->persist($entity,true);
        
        }catch (FileException $e){
            return new $e(`Une erreur c'est produite durant
            l'envoie de fichier`,400 );
        }
    }
}