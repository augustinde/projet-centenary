<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711151032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermunicipality DROP FOREIGN KEY FK_21A96E4198260155');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intermunicipality_department (intermunicipality_id INT NOT NULL, department_id INT NOT NULL, INDEX IDX_B65B561436D7F83 (intermunicipality_id), INDEX IDX_B65B561AE80F5DF (department_id), PRIMARY KEY(intermunicipality_id, department_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intermunicipality_department ADD CONSTRAINT FK_B65B561436D7F83 FOREIGN KEY (intermunicipality_id) REFERENCES intermunicipality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intermunicipality_department ADD CONSTRAINT FK_B65B561AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_21A96E4198260155 ON intermunicipality');
        $this->addSql('ALTER TABLE intermunicipality DROP region_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermunicipality_department DROP FOREIGN KEY FK_B65B561AE80F5DF');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE intermunicipality_department');
        $this->addSql('ALTER TABLE intermunicipality ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE intermunicipality ADD CONSTRAINT FK_21A96E4198260155 FOREIGN KEY (region_id) REFERENCES region (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_21A96E4198260155 ON intermunicipality (region_id)');
    }
}
