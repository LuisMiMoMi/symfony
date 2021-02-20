<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218162725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editorial (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE llibre ADD editorial_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE llibre ADD CONSTRAINT FK_BF9ADDAABAF1A24D FOREIGN KEY (editorial_id) REFERENCES editorial (id)');
        $this->addSql('CREATE INDEX IDX_BF9ADDAABAF1A24D ON llibre (editorial_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE llibre DROP FOREIGN KEY FK_BF9ADDAABAF1A24D');
        $this->addSql('DROP TABLE editorial');
        $this->addSql('DROP INDEX IDX_BF9ADDAABAF1A24D ON llibre');
        $this->addSql('ALTER TABLE llibre DROP editorial_id');
    }
}
