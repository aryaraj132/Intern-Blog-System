                        <?php $value = selectAll('add_intern'); ?>
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead style="background-color: rgb(24, 150, 24);">
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
										<th>Father's Name</th>
										<th>College Name</th>
										<th>Branch</th>
										<th>Mobile Number</th>
										<th>Email ID</th>
										<th>Ref. No.</th>
										<th>Topic</th>
										<th>Start Date</th>
										<th>End Date</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($value as $key => $values): ?>
                                    <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $values['name']; ?></td>
                                    <td><?php echo $values['f_name']; ?></td>
                                    <td><?php echo $values['college_name']; ?></td>
                                    <td><?php echo $values['branch']; ?></td>
                                    <td><?php echo $values['mob_no']; ?></td>
                                    <td><?php echo $values['email']; ?></td>
                                    <td><?php echo $values['ref_no']; ?></td>
                                    <td><?php echo $values['tech']; ?></td>
                                    <td><?php echo $values['start_date']; ?></td>
                                    <td><?php echo $values['end_date']; ?></td>
                                            <td><a href="edit_intern.php?id=<?php echo $values['id']; ?>" class="edit">Edit</a></td>
                                            <td><a href="edit_intern.php?del_id=<?php echo $values['id']; ?>" class="delete">Delete</a></td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>