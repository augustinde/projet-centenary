<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711144852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermunicipality DROP FOREIGN KEY FK_21A96E41AE80F5DF');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP INDEX IDX_21A96E41AE80F5DF ON intermunicipality');
        $this->addSql('ALTER TABLE intermunicipality CHANGE department_id region_id INT NOT NULL');
        $this->addSql('ALTER TABLE intermunicipality ADD CONSTRAINT FK_21A96E4198260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_21A96E4198260155 ON intermunicipality (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermunicipality DROP FOREIGN KEY FK_21A96E4198260155');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_21A96E4198260155 ON intermunicipality');
        $this->addSql('ALTER TABLE intermunicipality CHANGE region_id department_id INT NOT NULL');
        $this->addSql('ALTER TABLE intermunicipality ADD CONSTRAINT FK_21A96E41AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_21A96E41AE80F5DF ON intermunicipality (department_id)');
    }
}
