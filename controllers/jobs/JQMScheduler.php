<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class JQMScheduler extends JQW_Controller
{
	/**
	 * Controller initialization
	 */
	public function __construct()
	{
		parent::__construct();

		// Loads JQMSchedulerLib
		$this->load->library('extensions/FHC-Core-DVUH/JQMSchedulerLib');
	}

	//------------------------------------------------------------------------------------------------------------------
	// Public methods

	/**
	 * Creates jobs queue entries for requestMatrikelnummer job
	 */
	public function requestMatrikelnummer($studiensemester_kurzbz)
	{
		$this->logInfo('Start job queue scheduler FHC-Core-DVUH->requestMatrikelnummer');

		// If an error occured then log it
		$jobInputResult = $this->jqmschedulerlib->requestMatrikelnummer($studiensemester_kurzbz);

		if (isError($jobInputResult))
		{
			$this->logError(getError($jobInputResult));
		}
		else
		{
			// Add the new job to the jobs queue
			$addNewJobResult = $this->addNewJobsToQueue(
				JQMSchedulerLib::JOB_TYPE_REQUEST_MATRIKELNUMMER, // job type
				$this->generateJobs( // gnerate the structure of the new job
					JobsQueueLib::STATUS_NEW,
					getData($jobInputResult)
				)
			);

			// If error occurred return it
			if (isError($addNewJobResult)) $this->logError(getError($addNewJobResult));
		}

		$this->logInfo('End job queue scheduler FHC-Core-DVUH->requestMatrikelnummer');
	}

/*	public function sendMasterdata()
	{
		$this->logInfo('Start job queue scheduler FHC-Core-DVUH->sendMasterdata');

		// If an error occured then log it
		$jobInputResult = $this->jqmschedulerlib->sendMasterdata();

		if (isError($jobInputResult))
		{
			$this->logError(getError($jobInputResult));
		}
		else
		{
			// Add the new job to the jobs queue
			$addNewJobResult = $this->addNewJobsToQueue(
				JQMSchedulerLib::JOB_TYPE_SEND_MASTERDATA, // job type
				$this->generateJobs( // gnerate the structure of the new job
					JobsQueueLib::STATUS_NEW,
					getData($jobInputResult)
				)
			);

			// If error occurred return it
			if (isError($addNewJobResult)) $this->logError(getError($addNewJobResult));
		}

		$this->logInfo('End job queue scheduler FHC-Core-DVUH->sendMasterdata');
	}*/

	/**
	 * Creates jobs queue entries for sendCharge job
	 */
	public function sendCharge()
	{
		$this->logInfo('Start job queue scheduler FHC-Core-DVUH->sendCharge');

		// if there are previous jobs, only send data changed after the previous job
/*		$prevJobsResult = $this->getJobsByTypeStatus(JQMSchedulerLib::JOB_TYPE_SEND_CHARGE, JobsQueueLib::STATUS_DONE);

		$lastjobtime = null;

		if (hasData($prevJobsResult))
		{
			$lastJobsData = getData($prevJobsResult);

			$lastjobtime = $lastJobsData[0]->starttime;
		}*/

		$jobInputResult = $this->jqmschedulerlib->sendCharge();

		// If an error occured then log it
		if (isError($jobInputResult))
		{
			$this->logError(getError($jobInputResult));
		}
		else
		{
			// Add the new job to the jobs queue
			$addNewJobResult = $this->addNewJobsToQueue(
				JQMSchedulerLib::JOB_TYPE_SEND_CHARGE, // job type
				$this->generateJobs( // gnerate the structure of the new job
					JobsQueueLib::STATUS_NEW,
					getData($jobInputResult)
				)
			);

			// If error occurred return it
			if (isError($addNewJobResult)) $this->logError(getError($addNewJobResult));
		}

		$this->logInfo('End job queue scheduler FHC-Core-DVUH->sendCharge');
	}

	public function sendPayment()
	{
		$this->logInfo('Start job queue scheduler FHC-Core-DVUH->sendPayment');

		$jobInputResult = $this->jqmschedulerlib->sendPayment();

		// If an error occured then log it
		if (isError($jobInputResult))
		{
			$this->logError(getError($jobInputResult));
		}
		else
		{
			// Add the new job to the jobs queue
			$addNewJobResult = $this->addNewJobsToQueue(
				JQMSchedulerLib::JOB_TYPE_SEND_PAYMENT, // job type
				$this->generateJobs( // gnerate the structure of the new job
					JobsQueueLib::STATUS_NEW,
					getData($jobInputResult)
				)
			);

			// If error occurred return it
			if (isError($addNewJobResult)) $this->logError(getError($addNewJobResult));
		}

		$this->logInfo('End job queue scheduler FHC-Core-DVUH->sendPayment');
	}

	public function sendStudyData()
	{
		$this->logInfo('Start job queue scheduler FHC-Core-DVUH->sendStudyData');

/*		$prevJobsResult = $this->getJobsByTypeStatus(JQMSchedulerLib::JOB_TYPE_SEND_STUDY_DATA, JobsQueueLib::STATUS_DONE);

		$lastjobtime = null;

		if (hasData($prevJobsResult))
		{
			$lastJobsData = getData($prevJobsResult);
			$lastjobtime = $lastJobsData[0]->starttime;
		}*/

		$jobInputResult = $this->jqmschedulerlib->sendStudyData();

		// If an error occured then log it
		if (isError($jobInputResult))
		{
			$this->logError(getError($jobInputResult));
		}
		else
		{
			// Add the new job to the jobs queue
			$addNewJobResult = $this->addNewJobsToQueue(
				JQMSchedulerLib::JOB_TYPE_SEND_STUDY_DATA, // job type
				$this->generateJobs( // gnerate the structure of the new job
					JobsQueueLib::STATUS_NEW,
					getData($jobInputResult)
				)
			);

			// If error occurred return it
			if (isError($addNewJobResult)) $this->logError(getError($addNewJobResult));
		}

		$this->logInfo('End job queue scheduler FHC-Core-DVUH->sendCharge');
	}
}
