db['LoanStats3b-3'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$match: {
			$and:[
			{
			$or:[
			{"verification_status":"Not Verified"}
			]
			},
			{"dti":{$gt:30}}
			]
			}
		},

		// Stage 2
		{
			$group: {
			_id : { loan_status:"$loan_status"},
			count:{$sum:1}            
			}
		},
	],

	// Options
	{
		cursor: {
			batchSize: 50
		}
	}

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
