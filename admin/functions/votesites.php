<?php

class VoteSites {
    private $connection;

    public function __construct() {
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('website');
    }

    public function add_vote_site($site_url, $site_name, $vote_points = 1) {
        $stmt = $this->connection->prepare("INSERT INTO vote_sites (site_url, site_name, vote_points) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $site_url, $site_name, $vote_points);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function get_vote_sites() {
        $stmt = $this->connection->prepare("SELECT id, site_url, site_name, vote_points FROM vote_sites ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $vote_sites = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $vote_sites;
    }

    public function get_vote_site_by_id($id) {
        $stmt = $this->connection->prepare("SELECT * FROM vote_sites WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
}
?>
