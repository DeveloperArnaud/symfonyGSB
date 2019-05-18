<?php


namespace acmjBundle\RepositoriesTest;

use acmjBundle\Entity\Visiteur;
use PHPUnit\Framework\TestCase;

class FichefraisRepositoryTest extends TestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;



    public function testDavid() {
        $employee = new Visiteur();


        // Now, mock the repository so it returns the mock of the employee
        $employeeRepository = $this->createMock(Visiteur::class);
        // use getMock() on PHPUnit 5.3 or below
        // $employeeRepository = $this->getMock(ObjectRepository::class);
        $employeeRepository->expects($this->any())
            ->method('find')
            ->willReturn($employee);

        // Last, mock the EntityManager to return the mock of the repository
        $objectManager = $this->createMock(Visiteur::class);
        // use getMock() on PHPUnit 5.3 or below
        // $objectManager = $this->getMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($employeeRepository);

        $salaryCalculator = new SalaryCalculator($objectManager);
        $this->assertEquals(2100, $salaryCalculator->calculateTotalSalary(1));
    }

}