<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604211925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts ADD category_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA9777D11E FOREIGN KEY (category_id_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA9777D11E ON posts (category_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA9777D11E');
        $this->addSql('DROP INDEX IDX_885DBAFA9777D11E ON posts');
        $this->addSql('ALTER TABLE posts DROP category_id_id');
    }
}
