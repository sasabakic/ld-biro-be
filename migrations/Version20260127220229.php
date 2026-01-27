<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260127220229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB719D86650F');
        $this->addSql('DROP INDEX IDX_9413BB719D86650F ON salary');
        $this->addSql('ALTER TABLE salary CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB71A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9413BB71A76ED395 ON salary (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB71A76ED395');
        $this->addSql('DROP INDEX IDX_9413BB71A76ED395 ON salary');
        $this->addSql('ALTER TABLE salary CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB719D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9413BB719D86650F ON salary (user_id_id)');
    }
}
