<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615221329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, illustrer_id INT DEFAULT NULL, information_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C53D045F90F9B4E4 (illustrer_id), INDEX IDX_C53D045F2EF03101 (information_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE information (id INT AUTO_INCREMENT NOT NULL, sujet_id INT NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_297918837C4D497E (sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, object VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujet (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F90F9B4E4 FOREIGN KEY (illustrer_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F2EF03101 FOREIGN KEY (information_id) REFERENCES information (id)');
        $this->addSql('ALTER TABLE information ADD CONSTRAINT FK_297918837C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F2EF03101');
        $this->addSql('ALTER TABLE information DROP FOREIGN KEY FK_297918837C4D497E');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE information');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE sujet');
    }
}
