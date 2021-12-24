<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211224184527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, data_emprunt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt_user (emprunt_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C166DE57AE7FEF94 (emprunt_id), INDEX IDX_C166DE57A76ED395 (user_id), PRIMARY KEY(emprunt_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt_livre (emprunt_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_562087F2AE7FEF94 (emprunt_id), INDEX IDX_562087F237D925CB (livre_id), PRIMARY KEY(emprunt_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunt_user ADD CONSTRAINT FK_C166DE57AE7FEF94 FOREIGN KEY (emprunt_id) REFERENCES emprunt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunt_user ADD CONSTRAINT FK_C166DE57A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunt_livre ADD CONSTRAINT FK_562087F2AE7FEF94 FOREIGN KEY (emprunt_id) REFERENCES emprunt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunt_livre ADD CONSTRAINT FK_562087F237D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt_user DROP FOREIGN KEY FK_C166DE57AE7FEF94');
        $this->addSql('ALTER TABLE emprunt_livre DROP FOREIGN KEY FK_562087F2AE7FEF94');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE emprunt_user');
        $this->addSql('DROP TABLE emprunt_livre');
    }
}
