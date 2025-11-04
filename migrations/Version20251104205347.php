<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251104205347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, dedicated_employee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, pib INT NOT NULL, mbr INT NOT NULL, services_price NUMERIC(10, 2) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_C7440455FD5FB56A (dedicated_employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, entry_date DATE NOT NULL, status VARCHAR(255) NOT NULL, assigned_date DATE DEFAULT NULL, returned_date DATE DEFAULT NULL, entity_category VARCHAR(255) NOT NULL, INDEX IDX_D338D5838C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, issuer_id INT NOT NULL, client_id_id INT NOT NULL, amount INT NOT NULL, payment_status VARCHAR(255) NOT NULL, period_start DATE NOT NULL, period_end DATE NOT NULL, INDEX IDX_90651744BB9D6FEE (issuer_id), INDEX IDX_90651744DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salary (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, payment_status VARCHAR(255) NOT NULL, paid_date DATE DEFAULT NULL, period_month VARCHAR(255) NOT NULL, amount INT NOT NULL, INDEX IDX_9413BB719D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, salary INT NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455FD5FB56A FOREIGN KEY (dedicated_employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5838C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744BB9D6FEE FOREIGN KEY (issuer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB719D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455FD5FB56A');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5838C03F15C');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744BB9D6FEE');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744DC2902E0');
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB719D86650F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE salary');
        $this->addSql('DROP TABLE user');
    }
}
