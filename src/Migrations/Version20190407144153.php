<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407144153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, vote_id_id INT NOT NULL, author_id INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_9474526C2E2DFC9C (vote_id_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, for_count INT NOT NULL, against_count INT NOT NULL, date_created DATETIME NOT NULL, state INT NOT NULL, INDEX IDX_5A108564F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote_entry (id INT AUTO_INCREMENT NOT NULL, vote_id_id INT NOT NULL, author_id INT NOT NULL, opinion VARCHAR(255) NOT NULL, INDEX IDX_7A48FFBB2E2DFC9C (vote_id_id), INDEX IDX_7A48FFBBF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C2E2DFC9C FOREIGN KEY (vote_id_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote_entry ADD CONSTRAINT FK_7A48FFBB2E2DFC9C FOREIGN KEY (vote_id_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE vote_entry ADD CONSTRAINT FK_7A48FFBBF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C2E2DFC9C');
        $this->addSql('ALTER TABLE vote_entry DROP FOREIGN KEY FK_7A48FFBB2E2DFC9C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE vote_entry');
    }
}
