<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    public function findMineurs(){
        //Utiliser DQL basant sur modele objet
        //La requete DQL sera transofrmée en une requete SQL par Doctrine lors de l'execution

        $dateMajorite = new \DateTime("-18 years");

        // 1. Requête DQL
        $requeteDQL = "SELECT etudiant FROM App\Entity\Etudiant as etudiant WHERE etudiant.dateNaissance > :dateMajorite";

        // 2. Construire la requete cad representation objet de la requête
        $requete = $this->getEntityManager()->createQuery($requeteDQL);

        // 3. Donner une valeur au paramètre de la requête
        $requete->setParameter("dateMajorite", $dateMajorite);

        // 4. Exécuter la requête et retourner le résultat
        return $requete->getResult();
    }

    public function findMineurs2(){
        // Utiliser le Query Builder : classe permettant de construire
        // dynamiquement des requêtes DQL

        $dateMajorite = new \DateTime("-18 years");

        return $this->createQueryBuilder('e')
            ->where("e.dateNaissance > :dateMajorite")
            ->setParameter("dateMajorite", $dateMajorite)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
