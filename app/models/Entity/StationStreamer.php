<?php
namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;
use \GetId3\GetId3Core as GetId3;

/**
 * Station streamers (DJ accounts) allowed to broadcast to a station.
 *
 * @Table(name="station_streamers")
 * @Entity(repositoryClass="Repository\StationStreamerRepository")
 * @HasLifecycleCallbacks
 */
class StationStreamer extends \App\Doctrine\Entity
{
    public function __construct()
    {
        $this->is_active = true;
    }

    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @Column(name="station_id", type="integer") */
    protected $station_id;

    /** @Column(name="streamer_username", type="string", length=50, nullable=false) */
    protected $streamer_username;

    /** @Column(name="streamer_password", type="string", length=50, nullable=false) */
    protected $streamer_password;

    /** @Column(name="comments", type="text", nullable=true) */
    protected $comments;

    /** @Column(name="is_active", type="boolean", nullable=false) */
    protected $is_active;

    /**
     * @ManyToOne(targetEntity="Station", inversedBy="streamers")
     * @JoinColumns({
     *   @JoinColumn(name="station_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $station;

    /**
     * Static Functions
     */

    /**
     * Attempt to authenticate a streamer.
     *
     * @deprecated
     * @param Station $station
     * @param $username
     * @param $password
     * @return bool
     */
    public static function authenticate(Station $station, $username, $password)
    {
        return self::getRepository()->authenticate($station, $username, $password);
    }
}