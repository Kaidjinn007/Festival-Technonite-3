<?php
// Definition de l'emplacement de la repository
namespace App\Repository;

use App\Entity\Artist;                                                  // import de la classe Artiste de notre entité
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;  // import de service d'entité du bundle entity
use Doctrine\Persistence\ManagerRegistry;                               // import de la classe du ManagerRgistry

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository    // La classe ArtistRepository etend les attributs de la clase ServiceEntityRepository
{
    // La methode de portée publique __construct initialise les paramètres (ManagerRegistry et $registry)
    public function __construct(ManagerRegistry $registry) 

    {
        
    // :: = operateur de resolution de portée pour atteindre le parent depuis la classe
        parent::__construct($registry, Artist::class); 
    }

    // /**
    //  * @return Artist[] Returns an array of Artist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    // public function findOne($value): ?Artist
    // {
    //     return $this->createQueryBuilder('artist')
    //         ->andWhere('artist.exampleField = :id')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
    
    // On declare la méthode de recherche d'artiste par Identifiant decatégorie avec comme parametre l'Identifiant présenté sous forme de tableau
    public function findArtistesForCategory($id): array 
    {
        //on définit la variable qui procède à l'instanciation
        $entityManager = $this->getEntityManager();
        
        // Requête passée à la fonction qui choisi toute les entrées par 
        $query = $entityManager->createQuery(      
            'SELECT p
            FROM App\Entity\Artist p
            WHERE p.category ='.$id.'
            '
        );
        // on renvoie le résulte dela requete que l'on passe à fonction getResult
        return $query->getResult();
    }

    
    
    
}

