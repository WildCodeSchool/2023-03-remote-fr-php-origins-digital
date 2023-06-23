<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622074204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_bookmarks (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_1EAFBBA1A76ED395 (user_id), INDEX IDX_1EAFBBA129C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_likes (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_AEBDEA34A76ED395 (user_id), INDEX IDX_AEBDEA3429C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_bookmarks ADD CONSTRAINT FK_1EAFBBA1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_bookmarks ADD CONSTRAINT FK_1EAFBBA129C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_likes ADD CONSTRAINT FK_AEBDEA34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_likes ADD CONSTRAINT FK_AEBDEA3429C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video DROP FOREIGN KEY FK_9E05217429C1004E');
        $this->addSql('ALTER TABLE user_video DROP FOREIGN KEY FK_9E052174A76ED395');
        $this->addSql('DROP TABLE user_video');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_video (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_9E052174A76ED395 (user_id), INDEX IDX_9E05217429C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_video ADD CONSTRAINT FK_9E05217429C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video ADD CONSTRAINT FK_9E052174A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_bookmarks DROP FOREIGN KEY FK_1EAFBBA1A76ED395');
        $this->addSql('ALTER TABLE users_bookmarks DROP FOREIGN KEY FK_1EAFBBA129C1004E');
        $this->addSql('ALTER TABLE users_likes DROP FOREIGN KEY FK_AEBDEA34A76ED395');
        $this->addSql('ALTER TABLE users_likes DROP FOREIGN KEY FK_AEBDEA3429C1004E');
        $this->addSql('DROP TABLE users_bookmarks');
        $this->addSql('DROP TABLE users_likes');
    }
}
